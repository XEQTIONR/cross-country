package controllers

import (
	"cross-country/models"
	"cross-country/users"
	"cross-country/utilities"
	"fmt"
	"math"
	"net/http"
	"net/url"
	"strconv"
	"strings"

	"github.com/gin-gonic/gin"
)

func respond(c *gin.Context, data map[string]any) {
	acceptHeader := c.Request.Header.Get("Accept")

	if strings.Contains(acceptHeader, "application/json") {
		c.JSON(http.StatusOK, data)
	} else {
		c.HTML(http.StatusOK, "home", gin.H{"data": data})
	}
}

func getParams(c *gin.Context, orderBy, order string) (url.Values, string, string, string, string) {
	return c.Request.URL.Query(),
		c.DefaultQuery("perPage", "10"),
		c.DefaultQuery("page", "1"),
		c.DefaultQuery("orderBy", orderBy),
		c.DefaultQuery("order", order)
}

func getPaginationLinks(totalPages, page int, url string, filters utilities.Filters) []utilities.PaginationLink {
	links := []utilities.PaginationLink{}
	for i := 1; i <= totalPages; i++ {
		link := url + strconv.Itoa(i)
		for k, v := range filters {
			link = link + "&" + k + "=" + v
		}
		links = append(links, utilities.PaginationLink{
			Label:         strconv.Itoa(i),
			Link:          link,
			IsCurrentPage: i == page,
		})
	}

	return links
}

func BankAccountIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "id", "ASC")
	var err error
	var perPage, page, skip, total int
	var aArr []models.BankAccount
	var account models.BankAccount

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		aArr, err = account.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = account.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.BankAccount]{
		Items:      aArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func ConsignmentIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "created_at", "DESC")
	var err error
	var perPage, page, skip, total int
	var cArr []models.Consignment
	var consignment models.Consignment

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		cArr, err = consignment.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = consignment.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Consignment]{
		Items:      cArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func ContainerIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "created_at", "DESC")
	var err error
	var perPage, page, skip, total int
	var cArr []models.Container
	var container models.Container

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		cArr, err = container.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = container.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Container]{
		Items:      cArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func CustomerIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "id", "ASC")
	var err error
	var perPage, page, skip, total int
	var cArr []models.Customer
	var customer models.Customer

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		cArr, err = customer.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	fmt.Println(err)
	if err == nil {
		total, err = customer.Count(filters.ToSql())
	} else {
		fmt.Println("err not nil")
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Customer]{
		Items:      cArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func LcIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "created_at", "DESC")
	var err error
	var perPage, page, skip, total int
	var lcArr []models.Lc
	var lc models.Lc

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		lcArr, err = lc.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = lc.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Lc]{
		Items:      lcArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func OrderIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "balance", "DESC")
	var err error
	var perPage, page, skip, total int
	var oArr []models.Order
	var order models.Order

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		oArr, err = order.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = order.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Order]{
		Items:      oArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func PaymentIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "transaction_id", "DESC")
	var err error
	var perPage, page, skip, total int
	var pArr []models.Payment
	var payment models.Payment

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		pArr, err = payment.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = payment.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Payment]{
		Items:      pArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func TyreIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "tyre_id", "ASC")
	var err error
	var perPage, page, skip, total int
	var tArr []models.Tyre
	var tyre models.Tyre

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		tArr, err = tyre.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = tyre.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Tyre]{
		Items:      tArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func StockIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "tyre_id", "ASC")
	var err error
	var perPage, page, skip, total int
	var sArr []models.Stock
	var stock models.Stock

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		sArr, err = stock.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = stock.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[models.Stock]{
		Items:      sArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}

func UserIndex(c *gin.Context) {
	params, perPageParam, pageParam, orderByParam, orderParam := getParams(c, "id", "ASC")
	var err error
	var perPage, page, skip, total int
	var uArr []users.User
	var user users.User

	url := c.Request.URL.Path + fmt.Sprintf("?order=%s&orderBy=%s&perPage=%s&page=", orderParam, orderByParam, perPageParam)
	filters := utilities.GetFilters(c, params)

	perPage, err = strconv.Atoi(perPageParam)

	if err == nil {
		page, err = strconv.Atoi(pageParam)
		skip = (page - 1) * perPage
	}

	if err == nil {
		uArr, err = user.Get(filters.ToSql(), orderParam, orderByParam, skip, perPage)
	}

	if err == nil {
		total, err = user.Count(filters.ToSql())
	}

	totalPages := int(math.Ceil(float64(total) / float64(perPage)))
	links := getPaginationLinks(totalPages, page, url, filters)

	results := utilities.PaginatedResults[users.User]{
		Items:      uArr,
		Filters:    filters,
		PerPage:    perPage,
		TotalPages: totalPages,
		Page:       page,
		Total:      total,
		Links:      links,
		OrderBy:    orderByParam,
		Order:      orderParam,
	}

	if err == nil {
		respond(c, map[string]any{
			"err":  nil,
			"data": results,
		})

		return
	}

	respond(c, map[string]any{
		"err":  fmt.Sprintf("%v", err),
		"data": results,
	})
}
