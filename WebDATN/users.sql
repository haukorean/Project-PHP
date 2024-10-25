-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 06, 2024 lúc 06:04 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doctorbooking`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_user` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_user`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$txWG/BmlXWQay8y/.Q90tugtzmta1hYNo2Our2Lok3vf/hmk8fOxK', 1, 0, NULL, NULL, NULL),
(4, 'Pham Thuy', 'Thuy@gmail.com', NULL, '$2y$10$txWG/BmlXWQay8y/.Q90tugtzmta1hYNo2Our2Lok3vf/hmk8fOxK', 3, 0, NULL, '2023-12-17 07:48:17', '2023-12-21 09:55:24'),
(5, 'Trần Minh Khuyên', 'KhuyenTM@gmail.com', NULL, '$2y$10$OMcUNBxS66h4SkAwMrG8JOfDQsbcKZ/raHi4mCNfvqjlLitcAOXB.', 2, 1, NULL, '2023-12-21 10:04:37', '2023-12-21 10:06:58'),
(6, 'Mai Thị Minh Tâm', 'TamMTM@gmail.com', NULL, '$2y$10$6u991NEpKBv8alUpKn9ZwOF3t.k1H72c1.CQaiqfjV/lGh1Ik970e', 2, 1, NULL, '2023-12-23 06:27:53', '2023-12-23 06:30:09'),
(7, 'Phạm Trọng Nghĩa', 'NghiaPT@gmail.com', NULL, '$2y$10$dJAs17I9vy2L.ybHIlWsNuVwpxUJqSfoGvnm9Zo83n0pTg1Ej3mFy', 2, 1, NULL, '2023-12-25 05:31:38', '2023-12-25 05:33:55'),
(8, 'Nguyễn Văn Doanh', 'DanhNV@gmail.com', NULL, '$2y$10$eeTOQoHk09ge3lxmLcZH1e/V/ErmynqjU9Be/np0BT6MSMxRvybxi', 2, 1, NULL, '2023-12-25 05:57:46', '2023-12-25 06:00:28'),
(9, 'Đỗ Anh Vũ', 'VuDA@gmail.com', NULL, '$2y$10$/2vQHZHJFIAxS.TxoT2.QO5vperVLsiBD0pYxl56lR0hLL91TOshm', 2, 1, NULL, '2023-12-25 06:28:11', '2023-12-25 06:29:50'),
(10, 'Hà Văn Quyết', 'QuyetHV@gmail.com', NULL, '$2y$10$Zb7laKcFGENl1FlKkxLIuOVfY0nT4wGtXFpTVVdgqL8hue3/.6qTe', 2, 1, NULL, '2023-12-25 06:44:56', '2023-12-25 06:46:18'),
(11, 'Tiết Kim Phong', 'PhongKT@gmail.com', NULL, '$2y$10$40x1RENN6C7UZgSX2Ru2QOnA4.d9de7jvGH4uFsSLeIteomk5SHXm', 2, 1, NULL, '2023-12-25 06:48:14', '2023-12-25 06:49:11'),
(12, 'Lê Minh Đông', 'DongLM@gmail.com', NULL, '$2y$10$GFSy8hfmyxKses914TdGYeeP/lxgQJ7eayAAN6DnjYnAtpcqUs.ju', 2, 1, NULL, '2023-12-25 06:52:32', '2023-12-25 07:48:45'),
(13, 'Nguyễn Thị Hoài An', 'AnNTH@gmail.com', NULL, '$2y$10$EgHN8AeayPQ9TBeOmcmNlOpZYNr0r60JjXdDJvEq.y.nJ1fDUlT8i', 2, 1, NULL, '2023-12-25 07:55:13', '2023-12-25 07:58:11'),
(14, 'Lê Hữu Dương', 'DuongLH@gmail.com', NULL, '$2y$10$TRPXqJFfA/qaDlxU1jgvBug5SKslRqOtib9.sMftFgf9YexE2yLZS', 2, 1, NULL, '2023-12-25 08:05:18', '2023-12-25 08:06:18'),
(15, 'Nguyễn Quốc Giang', 'GiangNQ@gmail.com', NULL, '$2y$10$eS6il.AjovGoJVJ/P9yUJ..ijAOAROLQpoNYGrAtFidA6M5IKhwhG', 2, 1, NULL, '2023-12-25 08:13:33', '2023-12-25 08:15:08'),
(16, 'Bùi Phú Trưởng', 'TruongBP@gmail.com', NULL, '$2y$10$OYKYfXBgwehawpbiTPxu/.bNpLLqirppoy1EHxJk7i.B9OzVcuDcG', 2, 1, NULL, '2023-12-25 08:27:17', '2023-12-25 08:28:31'),
(17, 'Phùng Quang Tùng', 'TungPQ@gmail.com', NULL, '$2y$10$pp0tB6u9H8skp2hQBDM6ouumnda8R2dHtcmju7Jha9r7ElrzaJ/pG', 2, 1, NULL, '2023-12-25 08:30:53', '2023-12-25 08:31:51'),
(18, 'Dương Trọng Nghia', 'NghiaDT@gmail.com', NULL, '$2y$10$5iKiwDap152iOm9Q1UeWsOORjd6jkBAvNdio5Od2d5ohF2nCTOrG2', 2, 1, NULL, '2023-12-25 08:33:55', '2023-12-25 08:34:47'),
(19, 'Nguyễn Tuấn Minh', 'MinhNT@gmail.com', NULL, '$2y$10$fkwsXNmkjOVw7h5.yJWSoOi965oM4aXU/qII0IlU6XEiN1/wjbSJa', 2, 1, NULL, '2023-12-25 08:37:10', '2023-12-25 08:38:12'),
(20, 'Phạm Thị Quỳnh', 'QuynhPT@gmail.com', NULL, '$2y$10$16GN.b/V919QZGfbdkDwYOHCNp47K1jznFHeKIdAFPsirn.xtV6VO', 2, 1, NULL, '2023-12-25 08:44:29', '2023-12-25 08:45:32'),
(21, 'Nguyễn Xuân Chường', 'ChuongNX@gmail.com', NULL, '$2y$10$6kKUYESwgdRQ1ZeCEa4q6eknV9snxt9rTjvt.AOqI7KYiz/m/Ccm.', 2, 1, NULL, '2023-12-25 08:52:49', '2023-12-25 08:53:52'),
(22, 'Nguyễn Thị Phương Thảo', 'ThaoNTP@gmail.com', NULL, '$2y$10$c8fApzEoyes5tTbQnEHqSuStWjQGHOGZKBmznPHzTTQExNRAhn1EK', 2, 1, NULL, '2023-12-25 08:56:10', '2023-12-25 08:57:49'),
(23, 'Đoàn Thị Lan', 'LanDT@gmail.com', NULL, '$2y$10$fwN2QFn6F8xnEHt6Psm0Wu1kHSVDz/KggxnVmSd1hv3ghV8aXDgjC', 2, 1, NULL, '2023-12-25 09:01:43', '2023-12-25 09:02:36'),
(24, 'Nguyễn Hoài Chân', 'ChanNH@gmail.com', NULL, '$2y$10$sj54XfuXrAbN7QbTs/tV.ud4OB86Y0KHGnlAOhxsxIdb9wahGOuYy', 2, 1, NULL, '2023-12-25 09:04:31', '2023-12-25 09:05:21'),
(25, 'Vũ Thái Hà', 'HaVT@gmail.com', NULL, '$2y$10$Dp4ojevZa/MMiqqyrFRCgehgxfEqxJnI9DpVZwCIz7T5YwWI3JtZ.', 2, 1, NULL, '2023-12-25 09:07:50', '2023-12-25 09:08:31'),
(26, 'Nguyễn Tiến Thành', 'ThanhNT@gmail.com', NULL, '$2y$10$/O50fAQFYOUY.tkFkSLwbOQ67caKvX8zoySgh/cFpNK7BDsK.2rnm', 2, 1, NULL, '2023-12-25 09:12:01', '2023-12-25 09:13:03'),
(27, 'Nguyễn Xuân Thành', 'ThanhNX@gmail.com', NULL, '$2y$10$oBa5zZ3NPU5RkCCzkVHz2.ww0PKiDg1S0hUUp5ckMag3dKx6DyhdO', 2, 11, NULL, '2023-12-25 09:15:49', '2023-12-25 09:15:56'),
(28, 'Trần Hữu Bình', 'BinhTH@gmail.com', NULL, '$2y$10$ROnoZr3ac15z1Otam0Fq9ePLIeVtiZOPtq/wvFoLsFv6kIDlj72zG', 2, 1, NULL, '2023-12-27 09:11:20', '2023-12-27 09:13:01'),
(29, 'Lê Hồng Anh', 'AnhLH@gmail.com', NULL, '$2y$10$Ax3AKoHUvJZ1eIiohGvj/Opkpx6jlujBTCAy/UOnVjyDi5kiI4KgG', 2, 1, NULL, '2023-12-27 23:11:14', '2023-12-27 23:12:58'),
(30, 'Trần Thị Kim Thu', 'ThuTTK@gmail.com', NULL, '$2y$10$vgZ6XeKFW9FoRk7Ufc7oguZMM/x/q6D3HlIs9bcYP.twAdF36ltmm', 2, 1, NULL, '2023-12-27 23:19:17', '2023-12-27 23:20:42'),
(31, 'Nguyễn Tường Vũ', 'VuNT@gmail.com', NULL, '$2y$10$qMX6BPfVvdbTOeW86Q.TBOUa98HxxXF49TPA.qZc7yXsci4LcIsmO', 2, 1, NULL, '2023-12-27 23:24:14', '2023-12-27 23:25:29'),
(32, 'Ngô Đức Trường', 'TruongND@gmail.com', NULL, '$2y$10$zQ0Cjf7nH00VvGTLl/bOhuc7X7DukFhHj7uTEEBktCR/qWHr4Ch4m', 2, 1, NULL, '2023-12-27 23:40:04', '2023-12-27 23:44:27'),
(33, 'Bùi Việt Hưng', 'HungBV@gmail.com', NULL, '$2y$10$G.NgjiJYb6JijKLTWVX7eeUQ6ufeGSR2PpT6Fl2kd75vSaUSMNnT6', 2, 1, NULL, '2023-12-27 23:47:40', '2023-12-27 23:48:52'),
(34, 'Nguyễn Thu Trang', 'TrangNT@gmail.com', NULL, '$2y$10$wPSH50/Gwnv2KYs5leFBmeTiaB4mQX6BeSO3W0pgVVlkolQjZwRH.', 2, 1, NULL, '2023-12-27 23:53:24', '2023-12-27 23:55:13'),
(35, 'Hà Ngọc Mạnh', 'ManhHN@gmail.com', NULL, '$2y$10$.9ppl0aUc.P7XY2Gqgm74OKjl17WJWstvGQST9w3puhh0ivF4yQvO', 2, 1, NULL, '2023-12-27 23:58:42', '2023-12-27 23:59:34'),
(36, 'Nguyễn Đình Thuận', 'ThuanND@gmail.com', NULL, '$2y$10$m9Xq6T.khgb9S1D.zzfhVOYGaoEcnWxcIcSZ/OpF50KtIr2yFgjFu', 2, 1, NULL, '2023-12-28 00:05:16', '2023-12-28 00:06:12'),
(37, 'Pham Thế Hiển', 'HienPT@gmail.com', NULL, '$2y$10$tpxD86CopA5Fzb2xiL8WRObutiU0Xj084vm6fZ32NM2yh.GaU5bZ2', 3, 0, NULL, '2023-12-28 06:09:37', '2023-12-28 06:09:37');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_user` (`role_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
