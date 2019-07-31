package models

import (
	"github.com/jinzhu/gorm"
	"github.com/shopspring/decimal"
)

const (
	_ = iota
	// BillTypeToLandlord 向房东付款
	BillTypeToLandlord
	// BillTypeToCompany 向客户收租
	BillTypeToCompany
)

// Bill 账单
type Bill struct {
	gorm.Model
	Type       uint
	HouseID    uint            // 房间
	SalesmanID uint            // 业务员
	Amount     decimal.Decimal // 收款金额
}
