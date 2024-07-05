package db

import (
	"database/sql"
	"errors"
	"fmt"
	"os"

	"github.com/joho/godotenv"
)

func GetDBString() string {

	err := godotenv.Load(".env")

	if err == nil {
		name := []byte(os.Getenv("DB_NAME"))
		host := os.Getenv("DB_HOST")
		port := os.Getenv("DB_PORT")
		user := os.Getenv("DB_USERNAME")
		pass := os.Getenv("DB_PASSWORD")

		return fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?parseTime=true&loc=UTC", user, pass, host, port, name)
	}

	return ""
}

func Count(where, table string) (int, error) {
	if database, err := sql.Open("mysql", GetDBString()); err != nil {
		return 0, err
	} else {
		defer database.Close()
		if row, err := database.Query("SELECT COUNT(*) FROM " + table + " " + where); err != nil {
			return 0, err
		} else {
			defer row.Close()
			if row.Next() {
				var count int

				if err := row.Scan(&count); err != nil {
					return 0, err
				}

				return count, nil
			}

			return 0, errors.New("no more rows")
		}
	}
}
