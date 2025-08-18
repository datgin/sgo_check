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
        title: "HỌ TÊN",
    },
    {
        data: "email",
        name: "email",
        title: "EMAIL",
    },
    {
        data: "phone",
        name: "phone",
        title: "SỐ ĐIỆN THOẠI",
    },
    {
        data: "company",
        name: "company",
        title: "TÊN CÔNG TY",
    },
    {
        data: "logo",
        name: "logo",
        title: "LOGO",
        render: (data) =>
            data ? `<img src="${data}" width="40" height="40"/>` : "",
        orderable: false,
        searchable: false,
        width: "8%",
    },
    {
        data: "tax_number",
        name: "tax_number",
        title: "MÃ SỐ THUẾ",
        searchable: false,
    },
];
