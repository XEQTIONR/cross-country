package utilities

import (
	"cross-country/models"
	"cross-country/users"
)

type Entity interface {
	models.BankAccount | models.Consignment | models.Container | models.Customer | models.Lc |
		models.Order | models.Payment | models.Stock | models.Tyre | users.User
}
