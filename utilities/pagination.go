package utilities

type PaginatedResults[T any] struct {
	Items   []T     `json:"items"`
	Total   int     `json:"total"`
	Page    int     `json:"page"`
	PerPage int     `json:"per_page"`
	Filters Filters `json:"filters"`
}
