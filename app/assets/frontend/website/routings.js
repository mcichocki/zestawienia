const routings = new Map([
        ["default_route", "/"],
        ["api_users", "/_api/get/uzytkownicy"],
        ["api_jednostki", "/_api/get/jednostki"],
        ["jednostki_remove_all", "/jednostki/delete"],
        ["uzytkownicy_view", "/uzytkownicy/view/"],
        ["uzytkownicy_edit", "/uzytkownicy/edit/"],
        ["uzytkownicy_delete", "/uzytkownicy/delete/"],
        ["jednostki_worker", "/worker/jednostki"],
        ["zestawienia_archiwum", "/zestawienia/archiwum/"]
    ]
);

export default routings;