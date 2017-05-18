<html>
<head>
     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</head>
<body>
    <form action="./First" method="post">
        <p>班级号：</p>
                    <input type="text" name="id" id="courseid" value="7-8位">
        提交：<input type="submit">
    </form>
</body>
</html>
