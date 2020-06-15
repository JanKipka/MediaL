import Vue from 'vue';

Vue.filter('authors', function (authorArray) {
    if (authorArray) {
        let authors = authorArray.length;
        if (authors === 0) {
            return '';
        }
        let authorString = authorArray[0];
        if (authors === 1) {
            if (authorString.fullName) {
                authorString = authorString.fullName;
            }
            return authorString;
        }

        for (let i = 0; i < authors; i++) {
            let appendix = authorArray[i];
            if (appendix.fullName) {
                appendix = appendix.fullName;
            }
            authorString = authorString + ', ' + appendix;
        }
        return authorString;
    }

    return '';
});

Vue.filter('hasRead', function (hasRead) {
    return hasRead === 0 ? 'No' : 'Yes';
});

Vue.filter('isbn', function (industryIdentifiers) {
    if (industryIdentifiers) {
        for (let i = 0; i < industryIdentifiers.length; i++) {
            let id = industryIdentifiers[i];
            if (id.type === 'ISBN_10') {
                return id.identifier;
            }

            // fallback: return isbn-13
            return id.identifier;
        }
    }
    return '';
});

Vue.filter('date', function (date) {
    try {
        let parsedDate = new Date(date);
        return parsedDate.getFullYear();
    } catch (exception) {
        return date;
    }
});
