package models

import (
	"cross-country/db"
	"database/sql"
	"fmt"
	"strconv"
	"time"
)

type Payment struct {
	TransactionId int32   `json:"transaction_id"`
	OrderNum      int32   `json:"order_num"`
	PaymentAmount float32 `json:"payment_amount"`
	RefundAmount  float32 `json:"refund_amount"`
	Random        string  `json:"random"`
	Type          string  `json:"type"`
	Account       *int32  `json:"account"`

	CreatedAt time.Time  `json:"created_at"`
	UpdatedAt *time.Time `json:"updated_at"`
}

func (payment Payment) Get(where, order, orderBy string, offset, limit int) ([]Payment, error) {
	var (
		payments []Payment = []Payment{}
		query    string
	)
	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT * FROM payments " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT * FROM payments " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}

		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var p Payment
				if err := rows.Scan(&p.TransactionId, &p.OrderNum, &p.PaymentAmount, &p.RefundAmount, &p.Random,
					&p.CreatedAt, &p.UpdatedAt, &p.Type, &p.Account); err != nil {
					fmt.Println(err)
					return nil, err
				} else {
					payments = append(payments, p)
				}
			}
		}

		return payments, nil
	}
}

func (payment Payment) Count(where string) (int, error) {
	return db.Count(where, "payments")
}
