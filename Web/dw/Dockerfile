FROM python:3.7
 
COPY ./files /usr/local/
RUN pip install -i https://pypi.tuna.tsinghua.edu.cn/simple pycryptodome
WORKDIR /usr/local/ocococb
EXPOSE 10001

CMD ["python", "app.py"]