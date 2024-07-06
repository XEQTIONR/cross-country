export function currencyFormatter(number) {
    return decimalFormatter(number)
}

export function decimalFormatter(number, decimalPlaces = 2) {
    return parseFloat(number).toFixed(parseInt(decimalPlaces))
}

export function dateFormatter(date, format="DD/MM/YYYY") {

    const formats = {
        "YYYY-MM-DD" : "en-CA",
        "M/D/YYYY" : "en-US",
        "DD/MM/YYYY" : "en-GB",
        "D/M/YYYY" : "en-IN"
    }
    return (new Intl.DateTimeFormat(formats[format], {timeZone: "UTC"})).format(new Date(date));
}

export function dateTimeFormatter(dateTime) {
    return (new Intl.DateTimeFormat("en-GB", {
        timeStyle: "short",
        dateStyle: "short",
        timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone,
    })).format(new Date(dateTime));
}

export function multilineFormatter(text) {
    return text.replaceAll("\n", "<br>")
}