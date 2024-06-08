package lcs

import (
	"database/sql"
	"time"
)

var dbString string = "root:strong_password@tcp(127.0.0.1:3306)/nano_db?parseTime=true"

type Lc struct {
	LcNumber        string  `json:"lc_num"`
	DateIssued      string  `json:"date_issued"`
	DateExpiry      string  `json:"date_expiry"`
	Applicant       string  `json:"applicant"`
	Beneficiary     string  `json:"beneficiary"`
	CurrencyCode    string  `json:"currency_code"`
	ForeignAmount   float32 `json:"foreign_amount"`
	ForeignExpense  float32 `json:"foreign_expense"`
	DomesticExpense float32 `json:"domestic_expense"`
	ExchangeRate    float32 `json:"exchange_rate"`
	PortDepart      string  `json:"port_depart"`
	PortArrive      string  `json:"port_arrive"`
	InvoiceNo       string  `json:"invoice_no"`
	Notes           *string `json:"notes"`

	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func All() ([]Lc, error) {
	return Get("", "", "")
}

func Get(where, offset, limit string) ([]Lc, error) {
	var (
		lcs  []Lc
		err  error
		db   *sql.DB
		rows *sql.Rows
	)

	db, err = sql.Open("mysql", dbString)

	if err == nil {
		defer db.Close()
		query := "SELECT * FROM lcs " + where + limit + offset
		rows, err = db.Query(query)
		if err == nil {
			defer rows.Close()
			for rows.Next() {
				var lc Lc
				err = rows.Scan(&lc.LcNumber, &lc.DateIssued, &lc.DateExpiry,
					&lc.Applicant, &lc.Beneficiary, &lc.CurrencyCode,
					&lc.ForeignAmount, &lc.ForeignExpense, &lc.DomesticExpense, &lc.ExchangeRate,
					&lc.PortDepart, &lc.PortArrive,
					&lc.InvoiceNo, &lc.Notes,
					&lc.CreatedAt, &lc.UpdatedAt)

				if err == nil {
					lcs = append(lcs, lc)
				} else {
					break
				}
			}
		}
	}

	return lcs, err
}

func GetAlt(where, offset, limit string) ([]Lc, error) {
	var lcs []Lc = []Lc{}

	if db, err := sql.Open("mysql", dbString); err != nil {
		return lcs, err
	} else {
		defer db.Close()
		query := "SELECT * FROM lcs " + where + limit + offset
		if rows, err := db.Query(query); err != nil {
			return lcs, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var lc Lc
				if err := rows.Scan(&lc.LcNumber, &lc.DateIssued, &lc.DateExpiry,
					&lc.Applicant, &lc.Beneficiary, &lc.CurrencyCode,
					&lc.ForeignAmount, &lc.ForeignExpense, &lc.DomesticExpense, &lc.ExchangeRate,
					&lc.PortDepart, &lc.PortArrive,
					&lc.InvoiceNo, &lc.Notes,
					&lc.CreatedAt, &lc.UpdatedAt); err != nil {

					return lcs, err
				} else {
					lcs = append(lcs, lc)
				}
			}
		}
		return lcs, err
	}
}
