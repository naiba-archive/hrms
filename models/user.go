package models

import (
	"github.com/jinzhu/gorm"
)

// User 用户表
type User struct {
	gorm.Model
	Phone    string // 手机号
	Username string // 用户名
	Password string // 密码
}
