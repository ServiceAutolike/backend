// Account Page Views
import CategoryTransactionHistory from './components/pages/TransactionHistory'


export const routes = [
    // Account Page
    { path: '/facebook/history/:type', name: 'Transaction History',params: { type: "like"}, component: CategoryTransactionHistory},
    { path: '/facebook/history/:type', name: 'Transaction History Sub',params: { type: "sub"}, component: CategoryTransactionHistory},

];
