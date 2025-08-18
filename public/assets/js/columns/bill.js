const columns = [
    {
        data: "id",
        name: "id",
        title: "ID | NGÀY TẠO",
        orderable: true,
        searchable: false,
        width: "12%",
    },
    {
        data: "name",
        name: "name",
        title: "TÊN SẢN PHẨM",
    },
    {
        data: "image",
        name: "image",
        title: "HÌNH ẢNH",
        render: (data) =>
            data ? `<img src="${data}" width="40" height="40"/>` : "",
        orderable: false,
        searchable: false,
        width: "8%",
    },
    {
        data: "origin",
        name: "origin",
        title: "XUẤT XỨ",
    },
    {
        data: "product_code",
        name: "product_code",
        title: "MÃ SẢN PHẨM",
    },
    {
        data: "production_date",
        name: "production_date",
        title: "NGÀY SẢN XUẤT",
    },
    {
        data: "guarantee",
        name: "guarantee",
        title: "BẢO HÀNH",
    }
];
