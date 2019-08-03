package models

import (
	"time"

	"github.com/jinzhu/gorm"
)

const (
	_ = iota
	// ContractTypeToLandlord 跟房东签的合同
	ContractTypeToLandlord
	// ContractTypeToCompany 跟租户签的合同
	ContractTypeToCompany
)

// Contract 合同
type Contract struct {
	gorm.Model
	HouseID         uint      // 绑定房间
	PartyAID        uint      // 租客 · 甲方
	PartyBID        uint      // 业务员 · 乙方
	Type            uint      // 合同类型
	Deadline        time.Time // 截止时间
	FirstPaymentAt  time.Time // 第一次缴费时间
	PaymentDuration time.Time // 缴费间隔
	Establishment   time.Time // 建立时间
}
