package models

import (
	"github.com/jinzhu/gorm"
)

// Company ...
type Company struct {
	gorm.Model
	Brand    string // 公司名
	OwnerID  uint   // 管理员
	ParentID uint   // 所属母公司
}
