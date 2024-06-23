package utilities

import (
	"net/url"
	"strings"

	"github.com/gin-gonic/gin"
)

type Filters map[string]string

func GetFilters(c *gin.Context, p url.Values) Filters {
	f := Filters{}

	for k := range p {
		switch {
		case k == "perPage" || k == "page" || k == "orderBy" || k == "order":
			continue
		default:
			f[k], _ = c.GetQuery(k)
		}
	}
	return f
}

func (f Filters) ToSql() string {

	sql := ""
	for k, v := range f {

		arr := strings.SplitN(k, ".", 2)
		field := arr[0]
		oper := arr[1]
		clause := ""

		switch oper {
		case "lt":
			clause = field + " < " + v
		case "lte":
			clause = field + " <= " + v
		case "eq":
			clause = field + " = " + v
		case "neq":
			clause = field + " <> " + v
		case "gte":
			clause = field + " >= " + v
		case "gt":
			clause = field + " > " + v
		case "in":
			clause = field + " IN(" + v + ")"
		case "like":
			clause = field + " LIKE '" + v + "'"
		}

		if sql == "" {
			sql = "WHERE " + clause
		} else {
			sql += " AND " + clause
		}
	}

	return sql
}
