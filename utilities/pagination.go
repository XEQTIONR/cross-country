package utilities

type PaginatedResults[T any] struct {
	Items      []T              `json:"items"`
	Total      int              `json:"total"`
	Page       int              `json:"page"`
	PerPage    int              `json:"per_page"`
	TotalPages int              `json:"total_pages"`
	Filters    Filters          `json:"filters"`
	Links      []PaginationLink `json:"links"`
	OrderBy    string           `json:"order_by"`
	Order      string           `json:"order"`
}

type PaginationLink struct {
	Label         string `json:"label"`
	Link          string `json:"link"`
	IsCurrentPage bool   `json:"is_current_page"`
}
