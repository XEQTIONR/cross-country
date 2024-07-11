package models

import (
	"cross-country/db"
	"database/sql"
	"fmt"
	"time"
)

type Order struct {
	OrderNumber        int32   `json:"order_num"`
	CustomerId         int32   `json:"customer_id"`
	DiscountPercentage float32 `json:"discount_percentage"`
	DiscountAmount     float32 `json:"discount_amount"`
	TaxPercentage      float32 `json:"tax_percentage"`
	TaxAmount          float32 `json:"tax_amount"`
	Random             string  `json:"random"`

	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`

	OrderOn       string  `json:"order_on"`
	PaymentsTotal float32 `json:"payments_total" computed:"true"`
	NumPayments   int32   `json:"num_payments"`
	SubTotal      float32 `json:"sub_total" computed:"true"`

	GrandTotal float32 `json:"grand_total" computed:"true"`
	Balance    float32 `json:"balance" computed:"true"`
}

func (ord Order) Get(where, order, orderBy string, offset, limit int) ([]Order, error) {
	var (
		orders []Order = []Order{}
		query  string
	)

	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()

		query = fmt.Sprintf(`
			SELECT O.Order_num, O.customer_id, O.discount_percent, O.discount_amount, O.tax_percentage, O.tax_amount, O.random, O.created_at, O.updated_at, O.order_on,
			IFNULL(C.subtotal, 0), IFNULL(P.payment_total, 0) AS total_paid,
			(IFNULL(C.subtotal, 0) *  (1 + ((O.tax_percentage - O.discount_percent)/100)) + O.tax_amount - O.discount_amount) AS grand_total,
			(IFNULL(C.subtotal, 0) *  (1 + ((O.tax_percentage - O.discount_percent)/100)) + O.tax_amount - O.discount_amount - IFNULL(P.payment_total, 0)) AS balance,
			IFNULL(P.num_payments, 0) AS num_payments
			FROM orders O
				LEFT JOIN (
					SELECT Order_num, SUM(qty*unit_price) AS subtotal
					FROM order_contents GROUP BY Order_num)
						AS C ON O.Order_num = C.Order_num
				LEFT JOIN (
					SELECT Order_num, IFNULL(SUM(payment_amount - refund_amount), 0) AS payment_total, COUNT(Order_num) AS num_payments
					FROM payments GROUP BY Order_num) 
						AS P ON O.Order_num = P.Order_num
			%s
			`, where)

		if orderBy != "" {
			query = fmt.Sprintf(" %s ORDER BY %s %s ", query, orderBy, order)
		}

		query = fmt.Sprintf("%s LIMIT %d OFFSET %d", query, limit, offset)

		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var o Order
				if err := rows.Scan(&o.OrderNumber, &o.CustomerId, &o.DiscountPercentage,
					&o.DiscountAmount, &o.TaxPercentage, &o.TaxAmount, &o.Random, &o.CreatedAt, &o.UpdatedAt, &o.OrderOn,
					&o.SubTotal, &o.PaymentsTotal, &o.GrandTotal, &o.Balance, &o.NumPayments); err != nil {

					return nil, err
				} else {
					orders = append(orders, o)
				}
			}
		}
		return orders, nil
	}
}

func (ord Order) Count(where string) (int, error) {
	return db.Count(where, "orders")
}
