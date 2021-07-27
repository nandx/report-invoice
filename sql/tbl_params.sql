create table tbL_params
(
    id        bigint IDENTITY (1,1) primary key,
    param1    varchar(max),
    params2   varchar(max),
    params3   varchar(max),
    params4   varchar(max),
    noinvoice bigint
)

insert into tbL_params (param1, params2, params3, params4, noinvoice)
values ('Catatan : Apabila terdapat perbedaan data individu & jumlah premi, dapat disetorkan sesuai kondisi saat ini (Test)',
        'Pembayaran dilakukan paling lambat 14 (empat belas) hari kerja setelah pembayaran penghasilan perserta setap bulan , dengan mentransfer jumlah tersebut ke (test) :',
        'Setelah melakukan pembayaran tersebut, scan slip setoran dan softcopy data individu agar dilaporkan kepada kami melalui email (test) :',
        'premi@taspenlife.com (test)',
        246302);