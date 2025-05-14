<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & Vue</title>
</head>
<body>
    <!-- Khu vực Vue sẽ được render vào -->
    <div id="app"></div>

    <!-- Thêm script Vue đã biên dịch từ Laravel Mix -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
