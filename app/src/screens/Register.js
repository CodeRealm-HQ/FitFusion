import React, { useState } from 'react';
import { SafeAreaView, View, Alert, TouchableOpacity } from 'react-native';
import { Text, TextInput, Button, Checkbox, IconButton } from 'react-native-paper';
import Styles from '../config/Styles';
import Languages from '../languages';
import LanguageContext from '../languages/LanguageContext';
import ColorsApp from '../config/ColorsApp';
import usePreferences from '../hooks/usePreferences';
import { getAuth, createUserWithEmailAndPassword } from 'firebase/auth';

const auth = getAuth();

export default function Register(props) {

  const contextState = React.useContext(LanguageContext);
  const language = contextState.language;
  const Strings = Languages[language].texts;
  const {theme} = usePreferences();
  
  const [loading, setLoading] = useState(false);
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [checked, setChecked] = useState(false);

  const onChangeScreen = (screen) => {
    props.navigation.navigate(screen);
  };

  const register = async () => {

    setLoading(true);

    if(email, password, checked != false) {
      const errorHandler = ((e)=>{
          if(e.code == 'auth/email-already-in-use'){
            setLoading(false);
            Alert.alert(Strings.ST104, Strings.ST36);
             
          } else {
            setLoading(false);
            Alert.alert(Strings.ST104, Strings.ST33);
          }

      })
      await createUserWithEmailAndPassword(auth, email, password).then(() => {
          updateProfile({
              displayName : name ? name : '',
          }).then(()=>{
              setLoading(false);
          }).catch(errorHandler);

      }).catch(errorHandler)
    }else{
          setLoading(false);
          Alert.alert(Strings.ST104, Strings.ST33);
        }
      }

  return (

       <SafeAreaView style={{flex: 1, justifyContent: 'center'}}>
        <View style={Styles.AuthPage}>

    <View style={Styles.AuthContent}>

    <View style={{justifyContent:'center', alignItems:'center', marginBottom:40}}>
        <IconButton icon="account-plus" size={80}/>
        <Text style={{alignSelf:'center', fontSize: 16, textAlign:'center'}}>{Strings.ST140}</Text>
        </View>

    <TextInput label={Strings.ST18} onChangeText={text => setName(text)} mode="flat" style={Styles.AuthInput} />
    <TextInput label={Strings.ST19} onChangeText={text => setEmail(text.trim())} mode="flat" autoCapitalize="none" style={Styles.AuthInput} />
    <TextInput label={Strings.ST20} onChangeText={text => setPassword(text.trim())} mode="flat" secureTextEntry={true} style={Styles.AuthInput} />
    <View style={{justifyContent: 'flex-start', flexDirection: 'row', alignItems: 'center', marginTop: 10}}>
    <Checkbox.Android color={ColorsApp.PRIMARY} uncheckedColor={"#b9b9b9"} status={checked ? 'checked' : 'unchecked'} onPress={() => { setChecked(!checked); }} />
    <TouchableOpacity activeOpacity={0.8} onPress={() => onChangeScreen("terms")}>
    <Text style={Styles.AuthCheckBoxLabel}>{Strings.ST14}</Text>
    </TouchableOpacity>
    </View>
    <Button mode="contained" dark={theme === "dark" ? false : true} onPress={()=> register()} style={Styles.AuthButton} contentStyle={Styles.AuthButtonContent}>
    {!loading ? Strings.ST17 : Strings.ST31}
    </Button>

    <View style={Styles.AuthBottomContent}>
    <TouchableOpacity activeOpacity={0.9} onPress={() => onChangeScreen('login')}>
    <Text style={Styles.AuthBottomText}>
    {Strings.ST13} <Text style={{fontWeight: 'bold'}}>{Strings.ST34}</Text>
    </Text>
    </TouchableOpacity>
    </View>

    </View>
    </View>
    </SafeAreaView>

    );
}
