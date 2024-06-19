package db

import (
	"fmt"
	"os"

	"github.com/joho/godotenv"
)

func GetDBString() string {

	err := godotenv.Load(".env")

	if err == nil {
		name := []byte(os.Getenv("DB_NAME"))
		host := os.Getenv("DB_HOST")
		port := os.Getenv("DB_PORT")
		user := os.Getenv("DB_USERNAME")
		pass := os.Getenv("DB_PASSWORD")

		return fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?parseTime=true", user, pass, host, port, name)
	}

	return ""
}
