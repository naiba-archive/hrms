package models

import (
	"time"

	"github.com/jinzhu/gorm"
)

// Rental 租赁信息
type Rental struct {
	gorm.Model

	SalesmanID            uint      // 业务员
	TenantID              uint      // 租客
	ContractDeadline      time.Time // 合同截止时间
	ContractEstablishment time.Time // 合同建立时间
}
