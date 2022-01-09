// Account Page Views
import CategoryTransactionHistory from './components/pages/TransactionHistory'
import CategoryFacebookLike from './components/pages/FacebookBuffLike'
import CategoryFacebookSub from './components/pages/FacebookBuffSub'
import CategoryFacebookComment from './components/pages/FacebookBuffComment'
import CategoryDashboard from './components/pages/Dashboard'
import CategoryRechargeBank from './components/pages/recharge/Bank'
import CategoryRechargeMomo from './components/pages/recharge/Momo'
import CategoryRechargeCard from './components/pages/recharge/Card'
import CategoryRechargeHistory from './components/pages/recharge/History'

export const routes = [
    // Recharge
    { path: '/recharge/bank', name: 'RechargeBank', component: CategoryRechargeBank},
    { path: '/recharge/momo', name: 'RechargeMomo', component: CategoryRechargeMomo},
    { path: '/recharge/card', name: 'RechargeCard', component: CategoryRechargeCard},
    { path: '/recharge/history', name: 'RechargeHistory', component: CategoryRechargeHistory},
    // Account Page
    { path: '/home', name: 'Dashboard', component: CategoryDashboard},
    { path: '/facebook/history/:type', name: 'Transaction History',params: { type: "like"}, component: CategoryTransactionHistory},
    { path: '/facebook/history/:type', name: 'Transaction History Sub',params: { type: "sub"}, component: CategoryTransactionHistory},
    { path: '/facebook/buff-like', name: 'FacebookBuffLike', component: CategoryFacebookLike},
    { path: '/facebook/buff-follow', name: 'FacebookBuffSub', component: CategoryFacebookSub},
    { path: '/facebook/buff-comment', name: 'FacebookBuffComment', component: CategoryFacebookComment},

];
