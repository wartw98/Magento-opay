開發中的Magento 2  **[歐付寶 O'Pay (allPay)](https://www.opay.tw)** 的模組



## How to install
```
composer require wartw98/magentoopay
bin/magento setup:upgrade
rm -rf pub/static/* && php -dmemory_limit=1G bin/magento setup:static-content:deploy en_US zh_Hant_TW zh_Hans_CN -f
rm -rf var/di var/generation generated/code && php -dmemory_limit=1G bin/magento setup:di:compile
```


