<%@ page import="util.OracleCon" %>
<%@ page import="java.sql.SQLException" %>
<html>
<body>
<h2>Hello World!</h2>
</body>
<%

    String name =  request.getParameter("name");
    OracleCon oracleCon = new OracleCon();
    String res = null;
    System.out.println(oracleCon);
    try {
        res = oracleCon.selectByname(name);
    } catch (SQLException throwables) {
        throwables.printStackTrace();
    }
    out.println(res);
%>
</html>
