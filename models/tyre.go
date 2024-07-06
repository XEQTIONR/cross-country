package models

import (
	"cross-country/db"
	"database/sql"
	"strconv"
	"time"
)

type Tyre struct {
	TyreId  int32  `json:"tyre_id"`
	Brand   string `json:"brand"`
	Size    string `json:"size"`
	Lisi    string `json:"lisi"`
	Pattern string `json:"pattern"`

	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func (tyre Tyre) Get(where, order, orderBy string, offset, limit int) ([]Tyre, error) {
	var (
		tyres []Tyre = []Tyre{}
		query string
	)
	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT * FROM tyres " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT * FROM tyres " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}
		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var t Tyre
				if err := rows.Scan(&t.TyreId, &t.Brand, &t.Size, &t.Lisi, &t.Pattern,
					&t.CreatedAt, &t.UpdatedAt); err != nil {

					return nil, err
				} else {
					tyres = append(tyres, t)
				}
			}
		}

		return tyres, nil
	}
}

func (tyre Tyre) Count(where string) (int, error) {
	return db.Count(where, "tyres")
}
