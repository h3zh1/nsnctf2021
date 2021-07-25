<%@ page import="java.io.File" %>
<%@ page import="java.io.FileInputStream" %>
<%@ page import="java.util.Base64" %><%--
  Created by IntelliJ IDEA.
  User: h3zh1
  Date: 2021/7/13
  Time: 12:08 上午
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>java</title>
</head>
<body>
<%
    String pre = new File(application.getRealPath(request.getServletPath() )).getParent();
    String path = request.getParameter("pic");
    path = pre+"/"+path;
    System.out.println(path);
    File file = new File(path);
    try{
        FileInputStream inputStream = new FileInputStream(file);
        byte[] bytes = new byte[inputStream.available()];
        inputStream.read(bytes, 0, inputStream.available());
        out.println(new String(Base64.getEncoder().encode(bytes)));
    }catch (Exception e){
        e.printStackTrace();
        out.println("nothing");
    }

%>
</body>
</html>
