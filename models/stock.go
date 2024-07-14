package models

import (
	"cross-country/db"
	"database/sql"
	"strconv"
)

type Stock struct {
	Tyre
	Supply  int32 `json:"supply"`
	Sold    int32 `json:"sold"`
	Waste   int32 `json:"waste"`
	InStock int32 `json:"in_stock"`
}

func (stock Stock) Get(where, order, orderBy string, offset, limit int) ([]Stock, error) {
	var (
		stocks []Stock = []Stock{}
		query  string
	)

	query =
		`SELECT *, (supply - sold - waste) AS in_stock
		FROM(
			SELECT T.*, IFNULL(S.supply, 0) AS supply, IFNULL(O.sold, 0) AS  sold, IFNULL(W.waste, 0) AS waste 
			FROM tyres T
				LEFT JOIN (SELECT tyre_id, SUM(qty) AS supply FROM container_contents GROUP BY tyre_id) S
					ON T.tyre_id = S.tyre_id
				LEFT JOIN (SELECT tyre_id, SUM(qty) AS sold FROM order_contents GROUP BY tyre_id) O
					ON T.tyre_id = O.tyre_id
				LEFT JOIN (SELECT tyre_id, SUM(qty) AS waste FROM waste GROUP BY tyre_id) W
					ON T.tyre_id = W.tyre_id) X `

	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = query + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = query + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}

		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var s Stock
				if err := rows.Scan(&s.TyreId, &s.Brand, &s.Size, &s.Lisi, &s.Pattern,
					&s.CreatedAt, &s.UpdatedAt, &s.Supply, &s.Sold, &s.Waste, &s.InStock); err != nil {

					return nil, err
				} else {
					stocks = append(stocks, s)
				}
			}
		}

		return stocks, nil
	}
}

func (stock Stock) Count(where string) (int, error) {
	return db.Count(where, "tyres")
}
