package models

import (
	"cross-country/db"
	"database/sql"
	"fmt"
	"strconv"
	"time"
)

type Customer struct {
	Id      string  `json:"id"`
	Name    *string `json:"name"`
	Address *string `json:"address"`
	Phone   *string `json:"phone"`
	Notes   *string `json:"notes"`

	CreatedAt time.Time  `json:"created_at"`
	UpdatedAt *time.Time `json:"updated_at"`
}

func (customer Customer) Get(where, order, orderBy string, offset, limit int) ([]Customer, error) {
	var (
		customers []Customer = []Customer{}
		query     string
	)
	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT * FROM customers " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT * FROM customers " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}
		fmt.Println(query)
		if rows, err := database.Query(query); err != nil {
			fmt.Println("NO ROWS")
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				fmt.Println("ROW")
				var c Customer
				if err := rows.Scan(&c.Id, &c.Name, &c.Address, &c.Phone, &c.Notes, &c.CreatedAt, &c.UpdatedAt); err != nil {
					fmt.Println(err)
					return nil, err
				} else {
					customers = append(customers, c)
				}
			}
		}

		return customers, nil
	}
}

func (customer Customer) Count(where string) (int, error) {
	return db.Count(where, "customers")
}
