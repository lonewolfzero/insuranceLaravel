function show_detail(type, id) {
    if (type == "treaty") {
        location.href = "/retro/contract/treaty/" + id;
    } else if (type == "facultative") {
        location.href = "/retro/contract/facultative/" + id;
    }
}
