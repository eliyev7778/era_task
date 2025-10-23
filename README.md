# Bulk E-mail Laravel API

## Təsvir

Bu layihə adminin seçilmiş kriteriyalara uyğun istifadəçilərə böyük həcmdə e-mail göndərməsinə imkan verir.  
Backend Laravel + Passport ilə hazırlanıb, frontend React üçün tam funksional REST API təqdim edir.

## Quraşdırma

### 1. Repo klonlayın

```bash
git clone https://github.com/eliyev7778/era_task.git
```

### 2. .env faylını kopyalayın

```bash
cp .env.example .env
```

### 3. Composer paketlərini quraşdırın

```bash
composer install
```

### 4. Node.js paketlərini quraşdırın

```bash
$ npm install
```

### 5. Laravel açarını yaradın

```bash
$ php artisan key:generate
```

### 6. Database migrasiyalarını və seed-ləri işə salın və passport install edin

```bash
$ php artisan migrate --seed
```
### 6. Passport install edin və client id client secret env-ye elave edin

```bash
$ php artisan passport:install
$ php artisan passport:client --password
```

### 7. Modullardakı seed-ləri işə salın

```bash
$ php artisan module:make-seed
```

### 8. Server qaldırın

```bash
$ php artisan serve
```

### 9. Queue işlətmək

```bash
$ php artisan queue:work
```

### 10. Swagger/OpenAPI sənədlərini generasiya edin

```bash
$ php artisan l5-swagger:generate
```

### 11. Testlərin yoxlanılması

```bash
$ php artisan test
```

### swagger url http://127.0.0.1:8000/api/documentation

erDiagram


    ADMINS {
        BIGINT id PK
        STRING name
        STRING email
        STRING password
        DATETIME email_verified_at
        DATETIME created_at
        DATETIME updated_at
    }

    PRODUCTS {
        BIGINT id PK
        STRING name
        DECIMAL price
        INT stock
        ENUM status
        BIGINT category_id FK
        DATETIME created_at
        DATETIME updated_at
    }

    PRODUCT_CATEGORIES {
        BIGINT id PK
        STRING name
        DATETIME created_at
        DATETIME updated_at
    }

    PIVOT_PRODUCT_USER {
        BIGINT id PK
        BIGINT user_id FK
        BIGINT product_id FK
        ENUM type
        DATETIME created_at
        DATETIME updated_at
    }

    SEGMENTS {
        BIGINT id PK
        STRING name
        JSON filter_json
        DATETIME created_at
        DATETIME updated_at
    }

    CAMPAIGNS {
        BIGINT id PK
        STRING name
        STRING subject
        STRING template_key
        STRING from_email
        BIGINT segment_id FK
        JSON filter_json
        ENUM status
        INT total_recipients
        INT sent_count
        INT error_count
        BIGINT admin_id FK
        DATETIME created_at
        DATETIME updated_at
    }

    %% Relationships
    USERS ||--o{ PIVOT_PRODUCT_USER : "has"
    PRODUCTS ||--o{ PIVOT_PRODUCT_USER : "has"
    PRODUCTS }|--|| PRODUCT_CATEGORIES : "belongs to"
    USERS ||--o{ CAMPAIGN_USER : "receives"
    CAMPAIGNS ||--o{ CAMPAIGN_USER : "includes"
    CAMPAIGNS }|--|| SEGMENTS : "belongs to"
    CAMPAIGNS }|--|| ADMINS : "created by"

# Docker ilə Layihəsinin qurulması

---

## 1. Repo klonlayın
```bash
git clone https://github.com/eliyev7778/era_task.git
cd era_task
```
## 2. .env faylını yaradın
```bash
cp .env.example .env
```
## 3. Docker Compose ilə container-ləri işə salın
```bash
docker-compose up -d --build
```
## 4. Composer asılılıqlarını quraşdırın
```bash
docker-compose exec app composer install
```
## 5. Application key yaradın
```bash
docker-compose exec app php artisan key:generate
```
## 6. Database migration və seed
```bash
docker-compose exec app php artisan migrate --seed
```
## 7. Modulların seed-ləri
```bash
docker-compose exec app php artisan module:make-seed
```
## 8. Cache və config clear
```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan route:clear
```
## 9. Testləri işə salmaq
```bash
docker-compose exec app php artisan test
```
## 10. Queue işlətmək
```bash
docker-compose exec app php artisan queue:work
```
