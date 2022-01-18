// Account Page Views
import CategoryTransactionHistory from './components/pages/TransactionHistory'
import CategoryFacebookLike from './components/pages/FacebookBuffLike'
import CategoryFacebookSub from './components/pages/FacebookBuffSub'
import CategoryFacebookComment from './components/pages/FacebookBuffComment'
import CategoryFacebookShare from './components/pages/FacebookBuffShare'
import CategoryRechargeBank from './components/pages/recharge/Bank'
import CategoryRechargeMomo from './components/pages/recharge/Momo'
import CategoryRechargeCard from './components/pages/recharge/Card'
import CategoryRechargeHistory from './components/pages/recharge/History'
import PostAuth from './components/pages/auth/Posts'
import ServiceAuth from './components/pages/auth/Service'
import SupportAuth from './components/pages/auth/Support'
import SupportApp from './components/pages/app/Support'
import Chat from './components/pages/auth/Chat'
import UserAuth from './components/pages/auth/User'
import UserChangeAuth from './components/pages/auth/ChangeUser'
/// Acount
import CategoryDashboard from './components/pages/acounts/Dashboard'

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
    { path: '/facebook/buff-share', name: 'FacebookBuffShare', component: CategoryFacebookShare},
    { path: '/admin/post', name: 'Post', component: PostAuth},
    { path: '/admin/service', name: 'Service', component: ServiceAuth},
    { path: '/admin/support', name: 'SupportAuth', component: SupportAuth},
    { path: '/support/user', name: 'SupportApp', component: SupportApp},
    { path: '/support/chat/:code', name: 'Chat', component: Chat},
    { path: '/admin/user', name: 'User', component: UserAuth},
    { path: '/admin/user/change/:id', name: 'ChangeUser', component: UserChangeAuth},


];
