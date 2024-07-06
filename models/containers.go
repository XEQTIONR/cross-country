package models

import (
	"cross-country/db"
	"database/sql"
	"strconv"
	"time"
)

type Container struct {
	ContainerNum string `json:"container_num"`
	BOL          string `json:"bol"`

	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func (container Container) Get(where, order, orderBy string, offset, limit int) ([]Container, error) {
	var (
		containers []Container
		query      string
	)
	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT * FROM consignment_containers " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT * FROM consignment_containers " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}
		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var c Container
				if err := rows.Scan(&c.ContainerNum, &c.BOL, &c.CreatedAt, &c.UpdatedAt); err != nil {
					return nil, err
				} else {
					containers = append(containers, c)
				}
			}
		}

		return containers, nil
	}
}

func (container Container) Count(where string) (int, error) {
	return db.Count(where, "consignment_containers")
}
