package controller;

import java.lang.reflect.InvocationTargetException;
import java.util.Arrays;
import java.util.List;

public class IndexController {
    public static void main(String[] args) throws ClassNotFoundException, NoSuchMethodException, IllegalAccessException, InvocationTargetException {

        Class clazz = Class.forName("java.lang.Runtime"); //初始化Runtime类
        Object rt = clazz.getMethod("getRuntime").invoke(clazz); //调用Runtime类中的getRuntime方法得到Runtime类的对象
        clazz.getMethod("exec", List.class).invoke(rt, Arrays.asList("open /System/Applications/Calculator.app")); //再次使
       }


}
