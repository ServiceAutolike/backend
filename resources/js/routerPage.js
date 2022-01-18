// Facebook
import CategoryTransactionHistory from './components/pages/facebook/TransactionHistory'
import CategoryFacebookLike from './components/pages/facebook/FacebookBuffLike'
import CategoryFacebookSub from './components/pages/facebook/FacebookBuffSub'
import CategoryFacebookComment from './components/pages/facebook/FacebookBuffComment'
import CategoryFacebookShare from './components/pages/facebook/FacebookBuffShare'
import CategoryFacebookLiveStream from './components/pages/facebook/FacebookBuffLiveStream'
import CategoryFacebookAddMemGroup from './components/pages/facebook/FacebookAddMemGroup'

/// Acount
import CategoryDashboard from './components/pages/acounts/Dashboard'

// Recharge
import CategoryRechargeBank from './components/pages/recharge/Bank'
import CategoryRechargeMomo from './components/pages/recharge/Momo'
import CategoryRechargeCard from './components/pages/recharge/Card'
import CategoryRechargeHistory from './components/pages/recharge/History'
import FacebookAddMemGroup from "./components/pages/facebook/FacebookAddMemGroup";

export const routes = [
    // Recharge
    { path: '/recharge/bank', name: 'RechargeBank', component: CategoryRechargeBank},
    { path: '/recharge/momo', name: 'RechargeMomo', component: CategoryRechargeMomo},
    { path: '/recharge/card', name: 'RechargeCard', component: CategoryRechargeCard},
    { path: '/recharge/history', name: 'RechargeHistory', component: CategoryRechargeHistory},
    // Account Page
    { path: '/home', name: 'Dashboard', component: CategoryDashboard},

    /// Facebook
    { path: '/facebook/history/:type', name: 'Transaction History',params: { type: "like"}, component: CategoryTransactionHistory},
    { path: '/facebook/history/:type', name: 'Transaction History Sub',params: { type: "sub"}, component: CategoryTransactionHistory},
    { path: '/facebook/buff-like', name: 'FacebookBuffLike', component: CategoryFacebookLike},
    { path: '/facebook/buff-follow', name: 'FacebookBuffSub', component: CategoryFacebookSub},
    { path: '/facebook/buff-comment', name: 'FacebookBuffComment', component: CategoryFacebookComment},
    { path: '/facebook/buff-share', name: 'FacebookBuffShare', component: CategoryFacebookShare},
    { path: '/facebook/buff-livestream', name: 'FacebookBuffLiveStream', component: CategoryFacebookLiveStream},
    { path: '/facebook/buff-member-group', name: 'FacebookAddMemberGroup', component: FacebookAddMemGroup},


];
