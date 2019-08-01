package models

import (
	"github.com/jinzhu/gorm"
)

// House 房屋信息表
type House struct {
	gorm.Model
	LandlordID uint    // 房东
	ManagerID  uint    // 房屋管理员
	CompanyID  uint    // 所属公司
	ParentID   uint    // 母房屋（拆间合租）
	SKU        string  // 房间属性 例如 kt,xy,yb 代表 空调 向阳 浴霸
	Pics       string  // 房间图数组
	Note       string  // 房间备注
	Province   string  // 省
	Prefecture string  // 市
	County     string  // 县（区）
	Street     string  // 街道
	Community  string  // 小区
	Address    string  // 详细地址
	GisX       float64 // 经度
	GixY       float64 // 纬度
}
