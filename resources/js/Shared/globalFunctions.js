import moment from "moment";
import {usePage} from '@inertiajs/vue3'
import formTranslations from '@/Shared/Translations/formTranslations.json'
import {Translation} from "@/Shared/Translation";

function formatMinutes(totalMinutes) {
    let unRoundedMinutes = totalMinutes % 60

    let minutes = Math.round(unRoundedMinutes) < 10
        ? '0' + Math.round(unRoundedMinutes)
        : Math.round(unRoundedMinutes)

    let hours = (totalMinutes - (unRoundedMinutes)) / 60;
    hours = hours < 10
        ? '0' + hours
        : hours

    return hours + ":" + minutes;
}

function formatDate(date) {
    return date
        ? moment(date).format('DD-MM-YYYY')
        : null
}

function formatDateForDatabase(date) {
    return date
        ? moment(date).format('YYYY-MM-DD')
        : null
}

function formatDateTime(dateTime) {
    return dateTime
        ? moment(dateTime).format('DD-MM-YYYY HH:mm')
        : null
}

function formatDayDateTime(dateTime) {
    return dateTime
        ? moment(dateTime).format('dddd DD-MM-YYYY HH:mm')
        : null
}

function formatTime(dateTime) {
    return dateTime
        ? moment(dateTime).format('HH:mm')
        : null
}

function formatDayDate(dateTime) {
    return dateTime
        ? moment(dateTime).format('dddd DD-MM-YYYY')
        : null
}

function formatDateTimeFromNow(dateTime) {
    return dateTime
        ? moment(dateTime).fromNow(true)
        : null
}

function formatDateTimeDifference(startDate, endDate) {
    const start = moment(startDate);
    const end = moment(endDate);

    return end.from(start, true);
}

function toDateTimeString(dateTime) {
    return dateTime
        ? moment(dateTime).format('YYYY-MM-DD HH:mm:ss')
        : null
}

function toTwoDecimals(value) {
    return value
        ? value.toFixed(2)
        : null
}

function valuesToQueryString(values, key) {
    let queryString = ''

    values.forEach(value => {
        queryString += `&${key}[]=${value}`
    })

    return queryString
}

function arrayOfObjectsToQueryString(arrayOfObjects, displayKey, objectKey = 'id') {
    let queryString = ''

    arrayOfObjects.forEach(item => {
        queryString += '&' + displayKey + '[]=' + item[objectKey]
    })

    return queryString
}

function getUserLocale() {
    return usePage().props.locale
}

function removeFilter(filters, key, value) {
    filters[key] = filters[key].filter(option => option?.id !== value?.id)
}

function getBooleanOptions() {
    return [
        {
            id: 1,
            name: Translation.get(formTranslations.yes)
        },
        {
            id: 0,
            name: Translation.get(formTranslations.no)
        },
    ]
}

function formatTitleCase(str) {
    str = str.toLowerCase().split('-');

    for (let i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
    }

    return str.join(' ');
}

const tabTitleWithCount = (title, number) => {
    return title + ' (' + number + ')'
}

const calculatePercentage = (minority, total) => {
    try {
        if (total === 0) {
            return '0'
        }

        return ((minority / total) * 100)?.toFixed(2)
    } catch (exception) {
        return '-'
    }
}

const searchInArrayByObjectKey = (data, searchTerm, objectKeyToSearch = 'name', isMultilingual = true) => {

    if (searchTerm == null || searchTerm === '') {
        return data
    }

    if (isMultilingual) {
        return data.filter((item) =>
            Translation.get(item[objectKeyToSearch])
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(searchTerm.toLowerCase().replace(/\s+/g, ''))
        )
    }

    return data.filter((item) =>
        item[objectKeyToSearch]
            .toLowerCase()
            .replace(/\s+/g, '')
            .includes(searchTerm.toLowerCase().replace(/\s+/g, ''))
    )
}

const extractValuesOfTypeArrayFromQueryString = (queryString, paramName) => {
    const regex = new RegExp(`${paramName}\\[\\]=?(\\d+)`, 'g');
    const matches = queryString.match(regex);
    return matches ? matches.map(match => match.split('=')[1]).map(Number) : [];
}

export {
    formatMinutes,
    formatDate,
    formatDateTime,
    formatDayDateTime,
    toDateTimeString,
    valuesToQueryString,
    arrayOfObjectsToQueryString,
    getUserLocale,
    formatDayDate,
    formatTime,
    formatDateForDatabase,
    formatDateTimeFromNow,
    formatDateTimeDifference,
    removeFilter,
    toTwoDecimals,
    getBooleanOptions,
    formatTitleCase,
    tabTitleWithCount,
    calculatePercentage,
    searchInArrayByObjectKey,
    extractValuesOfTypeArrayFromQueryString
}
