package middleware

import (
	"cross-country/users"
	"fmt"
	"net/http"
	"strings"

	"github.com/gin-contrib/sessions"
	"github.com/gin-gonic/gin"
)

func Authorized(c *gin.Context) {
	var user users.User
	session := sessions.Default(c)
	userId := session.Get("id")
	where := fmt.Sprintf(" WHERE id = %d ", userId)

	users, err := user.Get(where, "", "", 0, 1)

	if err == nil {
		if len(users) == 1 {
			if users[0].Admin {
				c.Next()
				return
			}
		}
	}

	acceptHeader := c.Request.Header.Get("Accept")
	if strings.Contains(acceptHeader, "application/json") {
		c.AbortWithStatusJSON(http.StatusForbidden, gin.H{"errors": "unauthorized"})
	} else {
		c.Redirect(http.StatusTemporaryRedirect, "/unauthorized")
	}
}

func Authenticated(c *gin.Context) {
	session := sessions.Default(c)
	user := session.Get("id")

	if user == nil {
		acceptHeader := c.Request.Header.Get("Accept")

		session.Set("to", c.Request.RequestURI)
		session.Save()

		if strings.Contains(acceptHeader, "application/json") {
			c.AbortWithStatusJSON(http.StatusUnauthorized, gin.H{"errors": "unauthenticated"})
		} else {
			c.Redirect(http.StatusTemporaryRedirect, "/login")
		}
	}

	c.Next()
}
