// Account Page Views
import CategoryTransactionHistory from './components/pages/TransactionHistory'
import CategoryFacebookLike from './components/pages/FacebookBuffLike'
import CategoryFacebookSub from './components/pages/FacebookBuffSub'



export const routes = [
    // Account Page
    { path: '/facebook/history/:type', name: 'Transaction History',params: { type: "like"}, component: CategoryTransactionHistory},
    { path: '/facebook/history/:type', name: 'Transaction History Sub',params: { type: "sub"}, component: CategoryTransactionHistory},
    { path: '/facebook/buff-like', name: 'FacebookBuffLike', component: CategoryFacebookLike},
    { path: '/facebook/buff-follow', name: 'FacebookBuffSub', component: CategoryFacebookSub},

];
