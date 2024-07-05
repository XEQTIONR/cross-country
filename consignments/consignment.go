package consignments

import (
	"cross-country/db"
	"database/sql"
	"errors"
	"strconv"
	"time"
)

var dbString = db.GetDBString()

type Consignment struct {
	BOL          string  `json:"bol"`
	Value        float32 `json:"value"`
	ExchangeRate float32 `json:"exchange_rate"`
	Tax          float32 `json:"tax"`
	LandDate     string  `json:"land_date"`
	Lc           string  `json:"lc_num"`

	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func Get(where, order, orderBy string, offset, limit int) ([]Consignment, error) {
	var (
		consignments []Consignment
		query        string
	)
	if database, err := sql.Open("mysql", dbString); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT * FROM consignments " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT * FROM consignments " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}
		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var c Consignment
				if err := rows.Scan(&c.BOL, &c.Value, &c.ExchangeRate, &c.Tax, &c.LandDate, &c.Lc, &c.CreatedAt, &c.UpdatedAt); err != nil {
					return nil, err
				} else {
					consignments = append(consignments, c)
				}
			}
		}

		return consignments, nil
	}
}

func Count(where string) (int, error) {
	if database, err := sql.Open("mysql", dbString); err != nil {
		return 0, err
	} else {
		defer database.Close()
		if row, err := database.Query("SELECT COUNT(*) FROM consignments " + where); err != nil {
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
