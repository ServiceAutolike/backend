// Account Page Views
import CategoryTransactionHistory from './components/pages/TransactionHistory'
import CategoryFacebookLike from './components/pages/FacebookBuffLike'
import CategoryFacebookSub from './components/pages/FacebookBuffSub'
import CategoryFacebookComment from './components/pages/FacebookBuffComment'
import CategoryFacebookShare from './components/pages/FacebookBuffShare'
import CategoryDashboard from './components/pages/Dashboard'

export const routes = [
    // Account Page
    { path: '/home', name: 'Dashboard', component: CategoryDashboard},
    { path: '/facebook/history/:type', name: 'Transaction History',params: { type: "like"}, component: CategoryTransactionHistory},
    { path: '/facebook/history/:type', name: 'Transaction History Sub',params: { type: "sub"}, component: CategoryTransactionHistory},
    { path: '/facebook/buff-like', name: 'FacebookBuffLike', component: CategoryFacebookLike},
    { path: '/facebook/buff-follow', name: 'FacebookBuffSub', component: CategoryFacebookSub},
    { path: '/facebook/buff-comment', name: 'FacebookBuffComment', component: CategoryFacebookComment},
    { path: '/facebook/buff-share', name: 'FacebookBuffShare', component: CategoryFacebookShare},

];
