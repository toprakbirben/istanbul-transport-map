# Istanbul Transport Map

Realtime visualization of Istanbul’s unofficial transit network — showing **live bus positions** mapped over a **TomTom interactive map** using public APIs.

## 🚍 Overview

**Istanbul Transport Map** is an open-source project that provides a **real-time interactive map** of Istanbul buses and transit routes. It fetches live vehicle positions from transit APIs and overlays them on a **TomTom map**, allowing users to see where buses are at any given moment.

The goal of this project is to make Istanbul’s dynamic and unofficial transit movements easier to explore beyond static maps.

---

## 🚀 Features

### 🌐 Interactive Map
- Powered by **TomTom Maps SDK**
- Pan, zoom, and explore Istanbul interactively
- Route and vehicle overlays

### 🚍 Real-Time Bus Tracking
- Live bus positions fetched from transit APIs
- Automatic updates without page refresh
- Visual markers for active buses

### 🔄 API Integration
- Fetches real-time transit data
- Normalizes and processes vehicle positions
- Sends optimized data to the frontend

---

## 🛠️ Tech Stack

- **Map Provider:** TomTom Maps SDK  
- **Frontend:** JavaScript  
- **Backend:** Node.js  
- **Data Source:** Transit / bus location APIs  
- **Realtime Updates:** Polling or websocket-based updates  

---

## 📦 Installation

### 1️⃣ Clone the repository
```bash
git clone https://github.com/toprakbirben/istanbul-transport-map
cd istanbul-transport-map
```
### 2️⃣ Install Dependencies
```bash
composer install
```
### 3️⃣ Configure Environment Variables
Create a .env file and add your TomTom API key
```bash
cp .env.example .env
php artisan key:generate
```
### 4️⃣ Run the project
php artisan serve

### 🧠 How It Works
1.	Transit APIs provide real-time bus location data.
2.	The backend fetches and processes this data.
3.	The frontend renders buses as markers on a TomTom map.
4.	Data refreshes continuously to show live movement.

### 📌 Usage

Once running, open your browser and you will see:
1.	Live bus positions
2.	Interactive city map
3.	Continuously updating transit movement

Users can visually track buses in real time across Istanbul.


***

# İstanbul Ulaşım Haritası

İstanbul’un resmi olmayan toplu taşıma ağını **gerçek zamanlı** olarak görselleştiren bir proje — canlı otobüs konumları **TomTom interaktif haritası** üzerinde API’ler aracılığıyla gösterilir.

---

## 🚍 Genel Bakış

**İstanbul Ulaşım Haritası**, İstanbul’daki otobüslerin ve toplu taşıma hatlarının **gerçek zamanlı etkileşimli haritasını** sunan açık kaynaklı bir projedir. Otobüslerin konum verilerini toplu taşıma API’lerinden alır ve bu verileri **TomTom haritası** üzerinde gösterir. Böylece kullanıcılar otobüslerin nerede olduğunu anlık olarak görebilir.

Projenin amacı, İstanbul’un dinamik ve resmi olmayan ulaşım hareketlerini, statik haritaların ötesinde daha kolay keşfedilebilir hale getirmektir.

---

## 🚀 Özellikler

### 🌐 Etkileşimli Harita
- **TomTom Maps SDK** ile oluşturulmuştur  
- İstanbul’u yakınlaştırıp uzaklaştırarak ve kaydırarak keşfetme  
- Hatlar ve araç konumları katmanları  

### 🚍 Gerçek Zamanlı Otobüs Takibi
- Canlı otobüs konumları toplu taşıma API’lerinden çekilir  
- Sayfa yenilemeden otomatik güncellenir  
- Harita üzerinde aktif otobüsler işaretlenir  

### 🔄 API Entegrasyonu
- Gerçek zamanlı toplu taşıma verileri alınır  
- Araç konumları normalize edilip işlenir  
- Frontend’e optimize edilmiş şekilde aktarılır  

---

## 🛠️ Kullanılan Teknolojiler

- **Harita Sağlayıcısı:** TomTom Maps SDK  
- **Frontend:** JavaScript  
- **Backend:** PHP / Laravel  
- **Veri Kaynağı:** Toplu taşıma / otobüs konum API’leri  
- **Gerçek Zamanlı Güncelleme:** Polling veya WebSocket  

---

## 📦 Kurulum

### 1️⃣ Depoyu klonlayın
```bash
git clone https://github.com/toprakbirben/istanbul-transport-map
cd istanbul-transport-map
```
### 2️⃣ Bagimliliklari yukleyin
```bash
composer install
```
### 3️⃣ Ortam degiskenlerini olusturun
.env dosyasini olusturun ve TomTom API anahtarinizi ekleyin
```bash
cp .env.example .env
php artisan key:generate
```
### 4️⃣ Projeyi calistirin
php artisan serve

### 🧠 Nasıl Çalışır?
1.	Toplu taşıma API’leri otobüslerin gerçek zamanlı konum verilerini sağlar.
2.	Backend bu verileri alır ve işler.
3.	Frontend, otobüsleri TomTom haritası üzerinde işaretleyici olarak gösterir.
4.	Veriler sürekli güncellenir ve canlı hareket görüntülenir.

### 📌 Kullanım
Proje çalıştıktan sonra tarayıcınızı açtığınızda şunları görebilirsiniz:
1.	Canlı otobüs konumları
2.	Etkileşimli şehir haritası
3.	Sürekli güncellenen toplu taşıma hareketleri


Kullanıcılar İstanbul’daki otobüsleri gerçek zamanlı olarak takip edebilir.
