這個擴展將Magento 2是 [歐付寶O'Pay（allPay）]（https://www.opay.tw）的付款模組


##可用付款功能
1. 銀行卡
2. ATM
3. [獲取**條碼**付款]（https://www.youtube.com/watch?v=ujA-BOQV6GM）。
4. [分期付款**]（https://www.youtube.com/watch?v=rAkXZlP8Xok）。
5. [Magento結帳屏幕上的付款**選項**]（https://www.youtube.com/watch?v=V0vYTeRALyo）。
6. [**手機**模式]（https://www.youtube.com/watch?v=vZGABg-31xo）。
7. [**快速**模式：跳過帳單地址表單填寫]（https://www.youtube.com/watch?v=a-gTR5JNlwk）。

##截圖
###前台結帳屏幕
![]
(https://mage2.pro/uploads/default/original/2X/d/d5a9df1dccbd3b39848379b0aa7e5465c4a21adf.png)

###快速模式下的前端結帳屏幕
![]
(https://mage2.pro/uploads/default/original/2X/8/8c51244f8c9d30eb1afdea2cb8efcb45a91e0d39.png)

###後端訂單清單
![]
(https://mage2.pro/uploads/default/original/2X/d/da7d7adc8ff2ba83924a51fe6d9d5c73db949833.png)

###後端設置
![]
(https://mage2.pro/uploads/default/original/2X/c/c4d1d3bfe10360ca3d21dc978338a50be8138dc3.png)



＃＃ 如何安裝

```
composer require mage2pro/allpay:*
bin/magento setup:upgrade
rm -rf pub/static/* && bin/magento setup:static-content:deploy en_US zh_Hant_TW zh_Hans_CN
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
```

