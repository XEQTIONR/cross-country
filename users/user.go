package users

import (
	"context"
	"cross-country/db"
	"database/sql"
	"fmt"
	"strconv"

	_ "github.com/go-sql-driver/mysql"
	"golang.org/x/crypto/bcrypt"
)

var dbString string = "root:strong_password@tcp(127.0.0.1:3306)/use_me_db"

type User struct {
	Id           int64   `json:"id"`
	Name         string  `json:"name" gorm:"index;size:256"`
	PasswordHash string  `binding:"required" gorm:"size:256"`
	Email        string  `json:"email" gorm:"size:256"`
	Admin        bool    `json:"admin"`
	CreatedAt    *string `json:"created_at"`
	UpdatedAt    *string `json:"updated_at"`
}

func (u User) hashPassword(password string) (string, error) {
	bytes, err := bcrypt.GenerateFromPassword([]byte(password), 14)
	return string(bytes), err
}

// CheckPasswordHash compares a password to a hash and returns if it is valid or not.
func (u User) CheckPasswordHash(password string) bool {
	err := bcrypt.CompareHashAndPassword([]byte(u.PasswordHash), []byte(password))
	return err == nil
}

func (u *User) SetPassword(password string) error {
	hash, err := u.hashPassword(password)

	if err == nil {
		u.PasswordHash = hash
	}

	return err
}

func (u *User) Save() error {
	if db, err := sql.Open("mysql", dbString); err == nil {
		defer db.Close()
		if insert, err := db.ExecContext(
			context.Background(), fmt.Sprintf(`
			INSERT INTO users(name, email, password_hash, created_at, updated_at)
			VALUE('%s', '%s', '%s', NOW(), NOW())`, u.Name, u.Email, u.PasswordHash)); err == nil {
			if id, err := insert.LastInsertId(); err == nil {
				if results, err := db.Query(fmt.Sprintf(`
					SELECT id, name, email, created_at, updated_at 
					FROM users 
					WHERE id=%v AND deleted_at IS NULL
					LIMIT 1`, id)); err == nil {
					results.Next()
					return results.Scan(&u.Id, &u.Name, &u.Email, &u.CreatedAt, &u.UpdatedAt) // scan error or nil
				} else {
					return err // db query error
				}
			} else {
				return err // lastinsertId error
			}
		} else {
			return err //sql error
		}
	} else {
		return err //db connection error
	}
}

func FindByUsername(username string) User {
	var u User
	db, err := sql.Open("mysql", dbString)
	if err == nil {
		defer db.Close()
		if results, err := db.Query(fmt.Sprintf(`
			SELECT id, name, email, admin, password_hash, created_at, updated_at
			FROM users
			WHERE email = '%s' AND deleted_at IS NULL
			LIMIT 1
		`, username)); err == nil {
			results.Next()
			results.Scan(&u.Id, &u.Name, &u.Email, &u.Admin, &u.PasswordHash, &u.CreatedAt, &u.UpdatedAt)
		}
	}
	return u
}

func (user User) Get(where, order, orderBy string, offset, limit int) ([]User, error) {
	var (
		users []User = []User{}
		query string
	)
	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT id, name, email, admin, created_at, updated_at FROM users " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT id, name, email, admin, created_at, updated_at FROM users " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}
		fmt.Println(query)
		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var u User
				if err := rows.Scan(&u.Id, &u.Name, &u.Email, &u.Admin,
					&u.CreatedAt, &u.UpdatedAt); err != nil {

					return nil, err
				} else {
					users = append(users, u)
				}
			}
		}

		return users, nil
	}
}

func (user User) Count(where string) (int, error) {
	return db.Count(where, "users")
}
