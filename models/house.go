package models

import (
	"github.com/jinzhu/gorm"
)

// House ...
type House struct {
	gorm.Model
	Province   string // 省
	Prefecture string // 市
	County     string // 县（区）
	Address    string // 详细地址
}
