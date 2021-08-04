# 克隆项目

```shell
git clone https://github.com/pucoder/explore.git

cd explore
```

# 安装composer包

```shell
composer install
```

# 复制.env文件（配置数据库信息）

```shell
cp .env.example .env
```

# 生成应用密钥

```shell
php artisan key:generate
```

# 运行数据库迁移

```shell
php artisan migrate
```

运行数据库填充

```shell
php artisan db:seed --class=AdminTableSeeder
```

# 安装NPM依赖项

```shell
npm install
```

# 编译资源

```shell
npm run dev
```
