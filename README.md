開發中的Magento 2  **[歐付寶 O'Pay (allPay)](https://www.opay.tw)** 的模組



## Screenshots
### 前台畫面
![](https://mage2.pro/uploads/default/original/2X/d/d5a9df1dccbd3b39848379b0aa7e5465c4a21adf.png)

### 前台快速付款
![](https://mage2.pro/uploads/default/original/2X/8/8c51244f8c9d30eb1afdea2cb8efcb45a91e0d39.png)

### 後台訂單列表
![](https://mage2.pro/uploads/default/original/2X/d/da7d7adc8ff2ba83924a51fe6d9d5c73db949833.png)

### 後台設定
![](https://mage2.pro/uploads/default/original/2X/c/c4d1d3bfe10360ca3d21dc978338a50be8138dc3.png)

## How to install
```
composer require wartw98/magentoopay:* dev-master
bin/magento setup:upgrade
rm -rf pub/static/* && bin/magento setup:static-content:deploy en_US zh_Hant_TW zh_Hans_CN
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
```


