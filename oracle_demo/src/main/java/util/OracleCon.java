package util;

import java.sql.*;

public class OracleCon {
    ResultSet rs = null;
    PreparedStatement stmt = null;
    private static Connection conn = OracleCon.getConn();

    //获取Connection
    public static Connection getConn(){
        createCon();
        return conn;
    }

    private static void createCon() {
        try {
            //加载驱动和地址，及地址连接
            Class.forName("oracle.jdbc.driver.OracleDriver");
            String dbURL = "jdbc:oracle:thin:@//127.0.0.1:1521/XE";
            //用户名h3 密码h3zh1
            conn = DriverManager.getConnection(dbURL, "h3", "h3zh1");
            System.out.println(conn);
            System.out.println("数据库连接成功！");
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("数据库连接失败！");
        } finally {

        }

    }
    //通过name做select
    public String selectByname(String argname) throws SQLException {
        Statement statement = conn.createStatement();
        //sqlstring
        String sql = "select  * from stu where name='" + argname + "'";
        ResultSet resultSet = statement.executeQuery(sql);
        //提取结果
        String name = "";
        String age = "";
        while ( resultSet.next() )
        {
            name = resultSet.getString("name");
            age = resultSet.getString("age");
            System.out.println(name+" : "+age);
        }
        String res ="name : " + name + ", age : " + age;
        return res;
    }

   /* public static void main(String[] args) throws SQLException {
        OracleCon oracleCon = new OracleCon();
        oracleCon.createCon();
        Connection connection = oracleCon.getConn();

        Statement statement = connection.createStatement();
        ResultSet resultSet = statement.executeQuery("select  * from stu");
        //打印输出结果集
        while ( resultSet.next() )
        {
            String name = resultSet.getString("name");
            String age = resultSet.getString("age");
            System.out.println(name+" : "+age);
        }
    }*/
}
