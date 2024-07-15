package models

import (
	"cross-country/db"
	"database/sql"
	"strconv"
	"time"
)

type BankAccount struct {
	Id            int32  `json:"id"`
	BankName      string `json:"bank_name"`
	AccountName   string `json:"account_name"`
	AccountNumber string `json:"account_number"`
	BankAddress   string `json:"bank_address"`

	CreatedAt *time.Time `json:"created_at"`
	UpdatedAt *time.Time `json:"updated_at"`
}

func (account BankAccount) Get(where, order, orderBy string, offset, limit int) ([]BankAccount, error) {
	var (
		accounts []BankAccount = []BankAccount{}
		query    string
	)
	if database, err := sql.Open("mysql", db.GetDBString()); err != nil {
		return nil, err
	} else {
		defer database.Close()
		if orderBy == "" {
			query = "SELECT * FROM bank_accounts " + where + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		} else {
			query = "SELECT * FROM bank_accounts " + where + " ORDER BY " + orderBy + " " + order + " LIMIT " + strconv.Itoa(limit) + " OFFSET " + strconv.Itoa(offset)
		}
		if rows, err := database.Query(query); err != nil {
			return nil, err
		} else {
			defer rows.Close()
			for rows.Next() {
				var a BankAccount
				if err := rows.Scan(&a.Id, &a.BankName, &a.AccountName, &a.AccountNumber, &a.BankAddress,
					&a.CreatedAt, &a.UpdatedAt); err != nil {

					return nil, err
				} else {
					accounts = append(accounts, a)
				}
			}
		}

		return accounts, nil
	}
}

func (account BankAccount) Count(where string) (int, error) {
	return db.Count(where, "bank_accounts")
}
