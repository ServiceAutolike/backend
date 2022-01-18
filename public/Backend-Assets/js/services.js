function timeAgo(dateString) {
    const date = new Date(dateString);
    const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
    const today = new Date();
    const seconds = Math.round((today - date) / 1000);

    if (seconds < 20) {
        return 'Vừa xong';
    }
    else if (seconds < 60) {
        return '1 phút trước';
    }

    const minutes = Math.round(seconds / 60);
    if (minutes < 60) {
        return `${minutes} phút trước`;
    }

    const isToday = today.toDateString() === date.toDateString();
    if (isToday) {
        return 'Hôm nay'
    }

    const yesterday = new Date(today - DAY_IN_MS);
    const isYesterday = yesterday.toDateString() === date.toDateString();
    if (isYesterday) {
        return 'Hôm qua'
    }

    const daysDiff = Math.round((today - date) / (1000 * 60 * 60 * 24));
    if (daysDiff < 30) {
        return `${daysDiff} ngày trước`;
    }

    const monthsDiff = today.getMonth() - date.getMonth() + (12 * (today.getFullYear() - date.getFullYear()));
    if (monthsDiff < 12) {
        return `${monthsDiff} tháng trước`;
    }

    const yearsDiff = today.getYear() - date.getYear();
    return `${yearsDiff} năm trước`;
}
