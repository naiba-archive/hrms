package models

import (
	"github.com/jinzhu/gorm"
)

// House 房屋信息表
type House struct {
	gorm.Model
	ParentID        uint   // 母房屋（拆间合租）
	CompanyID       uint   // 所属公司
	SalesmanID      uint   // 业务员
	SKU             string // 房间属性 例如 kt,xy,yb 代表 空调 向阳 浴霸
	Landlord        string // 房东
	LandlordContact string // 房东联系方式
	Province        string // 省
	Prefecture      string // 市
	County          string // 县（区）
	Street          string // 街道
	Community       string // 小区
	Address         string // 详细地址
}
