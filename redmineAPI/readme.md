# How to use
[1] Put the `redmineApi` folder to the `modules` in your Yii2 project.

[2] Include these settings to your modules section in config file. Where `@app` will be your application root directory (e.g. `@frontend` or `@backend` for advanced template)
```sh
'modules' => [
        'redmine-api' => [
            'class' => '@app\modules\redmineAPI\Module',
            'aliases' => [
                '@redmineModule' => '@app/modules/redmineAPI',
            ],
            'modules' => [
                'gridview' =>  [
                    'class' => '\kartik\grid\Module'
                ],
            ],
            'components' =>
                [
                    'redmine' =>
                        [
                            'class' => 'redmineModule\components\RedmineClientComponent',
                            'api_key' => '{your_api_key}',
                            'password' => '{your_password}',
                            'endpoint' => 'https://redmine.yanpix.com'
                        ],
                    'formatter' => [
                        'class' => 'yii\i18n\Formatter',
                        'dateFormat' => 'y-MM-dd',
                        'datetimeFormat' => 'y-MM-dd H:i:s',
                        'timeFormat' => 'php:H:i:s',
                        'timeZone' => 'UTC'
                    ],
                ],
        ],
    ],
```

[3] Go to the composer.json and set the following dependencies for this module

```sh
   "require": {
        "kbsali/redmine-api": "~1.0",
        "kartik-v/yii2-grid": "@dev",
        "kartik-v/yii2-widget-select2": "*",
        "kartik-v/yii2-date-range": "dev-master",
        "kartik-v/yii2-export": "*"
}
```
 and run  
 ```sh
$ composer update
```
[4] The application will be available by this link `http://localhost/redmine-api/projects`

