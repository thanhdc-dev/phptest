# Giới thiệu

Họ và tên: **Đinh Công Thành**

Email: **dev.thanhdc@gmail.com**

# Mô tả

Repo này là mã nguồn bài làm PHPTest 

# Cài đặt

## 1. Clone repo

```shell
git clone https://github.com/thanhdc-dev/phptest.git
```

## 2. Thiết lập cấu hình

- Copy file .env.example và chỉnh sửa lại thônng tin kết nối CSDL phù hợp (DB_USERNAME, DB_PASSWORD, ...)
    ```shell
    cd phptest
    cp .env.example .env
    ```

- Chạy composer
    ```shell
    composer install
    ```
## 3. Nhập dữ liệu mẫu

Nhập file *sql* mẫu *php_test.sql* bằng phầm mềm hoặc thông qua terminal

```shell
mysql -u username -p php_test < php_test.sql
```

## 4. Test

Tài khoản mẫu
- email: dev.thanhdc@gmail.com
- password: 123456
